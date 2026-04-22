import React from "react";
import { StoreContext } from "../../../store/StoreContext";
import { useInfiniteQuery } from "@tanstack/react-query";
import { queryDataInfinite } from "../../../functions/custom-hooks/queryDataInfinite";
import { apiVersion, formatDate } from "../../../functions/functions-general";
import { useInView } from "react-intersection-observer";
import NoData from "../../../partials/NoData";
import ServerError from "../../../partials/ServerError";
import TableLoading from "../../../partials/TableLoading";
import FetchingSpinner from "../../../partials/spinners/FetchingSpinner";
import Loadmore from "../../../partials/Loadmore";
import Status from "../../../partials/Status";
import SearchBar from "../../../partials/SearchBar";
import { FaArchive, FaEdit, FaTrash, FaTrashRestore, FaFileAlt } from "react-icons/fa";
import ModalDelete from "../../../partials/modals/ModalDelete";
import ModalRestore from "../../../partials/modals/ModalRestore";
import ModalArchive from "../../../partials/modals/ModalArchive";
import {
  setIsAdd,
  setIsArchive,
  setIsDelete,
  setIsRestore,
  setIsView,
} from "../../../store/StoreAction";

const MemoList = ({ itemEdit, setItemEdit }) => {
  const { store, dispatch } = React.useContext(StoreContext);
  
  const [filterData, setfilterData] = React.useState("");
  const [page, setPage] = React.useState(1);
  const [onSearch, setOnSearch] = React.useState(false);
  const search = React.useRef({ value: "" });
  const { ref, inView } = useInView();
  let counter = 1;

  const {
    data: result,
    error,
    fetchNextPage,
    hasNextPage,
    isFetching,
    isFetchingNextPage,
    status,
  } = useInfiniteQuery({
    queryKey: ["memo", search.current.value, store.isSearch, filterData],
    queryFn: async ({ pageParam = 1 }) =>
      await queryDataInfinite(
        ``, 
        `${apiVersion}/controllers/developers/memo/page.php?start=${pageParam}`, 
        false,
        {
          filterData,
          searchValue: search?.current?.value,
        },
        `post`,
      ),
    getNextPageParam: (lastPage) => {
      if (lastPage.page < lastPage.total) {
        return lastPage.page + lastPage.count;
      }
      return;
    },
    refetchOnWindowFocus: false,
  });

  const handleEdit = (item) => {
    dispatch(setIsAdd(true));
    setItemEdit(item);
  };
  const handleView = (item) => {
    dispatch(setIsView(true));
    setItemEdit(item);
  };
  const handleArchive = (item) => {
    dispatch(setIsArchive(true));
    setItemEdit(item);
  };
  const handleRestore = (item) => {
    dispatch(setIsRestore(true));
    setItemEdit(item);
  };
  const handleDelete = (item) => {
    dispatch(setIsDelete(true));
    setItemEdit(item);
  };

  React.useEffect(() => {
    if (inView) {
      setPage((prev) => prev + 1);
      fetchNextPage();
    }
  }, [inView]);

  return (
    <>
      <div className="py-5 flex items-center justify-between">
        <div className="relative">
          <label>Status</label>
          <select
            onChange={(e) => setfilterData(e.target.value)}
            value={filterData}
          >
            <option value="">All</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
        <SearchBar
          search={search}
          dispatch={dispatch}
          store={store}
          result={result?.pages}
          isFetching={isFetching}
          setOnSearch={setOnSearch}
          onSearch={onSearch}
        />
      </div>

<div className="relative pt-4 rounded-md ">
        {status !== "pending" && isFetching && <FetchingSpinner />}
        <table>
          <thead className="text-center">
            <tr>
               <th>#</th>
              <th>Status</th>
              <th>Date</th>
              <th>Category</th>
              <th>Memo</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {!error &&
              (status === "pending" || result?.pages[0]?.count === 0) && (
                <tr>
                  <td colSpan="100%" className="p-10">
                    {status === "pending" ? (
                      <TableLoading cols={2} count={20} />
                    ) : (
                      <NoData />
                    )}
                  </td>
                </tr>
              )}
            {error && (
              <tr>
                <td colSpan="100%" className="p-10">
                  <ServerError />
                </td>
              </tr>
            )}
            {result?.pages?.map((page, key) => (
              <React.Fragment key={key}>
                {page?.data?.map((item, key) => {
                  return (
                    <tr className="text-center" key={key}>
                      <td>{counter++}</td>
                      <td>
                        <Status
                          text={`${item.memo_is_active === 1 ? "active" : "inactive"}`}
                        />
                      </td>
                      <td>{formatDate(item.memo_date, "--", "short-date")}</td>
                      <td>{item.memo_category}</td>
                      <td className="truncate max-w-[200px]" title={item.memo_text?.split('\n')[0]}>
                        {item.memo_text?.split('\n')[0]}
                      </td>
                      
                      <td>
                        <div className="flex items-center justify-center gap-3 ">
                          <button
                            type="button"
                            className="tooltip-action-table"
                            data-tooltip="View"
                            onClick={() => handleView(item)}
                          >
                            <FaFileAlt />
                          </button>
                          {item.memo_is_active === 1 ? (
                            <>
                              <button
                                type="button"
                                className="tooltip-action-table"
                                data-tooltip="Edit"
                                onClick={() => handleEdit(item)}
                              >
                                <FaEdit />
                              </button>
                              <button
                                type="button"
                                className="tooltip-action-table"
                                data-tooltip="Archive"
                                onClick={() => handleArchive(item)}
                              >
                                <FaArchive />
                              </button>
                            </>
                          ) : (
                            <>
                              <button
                                type="button"
                                className="tooltip-action-table"
                                data-tooltip="Restore"
                                onClick={() => handleRestore(item)}
                              >
                                <FaTrashRestore />
                              </button>
                              <button
                                type="button"
                                className="tooltip-action-table"
                                data-tooltip="Delete"
                                onClick={() => handleDelete(item)}
                              >
                                <FaTrash />
                              </button>
                            </>
                          )}
                        </div>
                      </td>
                    </tr>
                  );
                })}
              </React.Fragment>
            ))}
          </tbody>
        </table>
        
        <div className="loadmore flex justify-center flex-col items-center pb-10">
          <Loadmore
            fetchNextPage={fetchNextPage}
            isFetchingNextPage={isFetchingNextPage}
            hasNextPage={hasNextPage}
            result={result?.pages[0]}
            setPage={setPage}
            page={page}
            refView={ref}
            isSearchOrFilter={store.isSearch || store?.isFilter}
          />
        </div>
      </div>

      {store.isArchive && (
        <ModalArchive
          mysqlApiArchive={`${apiVersion}/controllers/developers/memo/active.php?id=${itemEdit.memo_aid}`}
          dataItem={itemEdit}
          queryKey="memo"
          msg="Are you sure you want to archive this memo?"
          successMsg="Successfully archived."
          item={itemEdit.memo_category}
        />
      )}
      {store.isRestore && (
        <ModalRestore
          mysqlApiRestore={`${apiVersion}/controllers/developers/memo/active.php?id=${itemEdit.memo_aid}`}
          dataItem={itemEdit}
          queryKey="memo"
          msg="Are you sure you want to restore this memo?"
          successMsg="Successfully restored."
          item={itemEdit.memo_category}
        />
      )}
        {store.isDelete && (
        <ModalDelete
          mysqlApiDelete={`${apiVersion}/controllers/developers/memo/memo.php?id=${itemEdit.memo_aid}`}
          dataItem={itemEdit}
          queryKey="memo"
          msg="Are you sure you want to delete this memo?"
          successMsg="Successfully deleted."
          item={itemEdit.memo_category}
        />
      )}
    </>
  );
};

export default MemoList;