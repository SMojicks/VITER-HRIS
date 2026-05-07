import React from "react";
import { StoreContext } from "../../../../store/StoreContext";
import { useInfiniteQuery } from "@tanstack/react-query";
import { queryDataInfinite } from "../../../../functions/custom-hooks/queryDataInfinite";
import { apiVersion } from "../../../../functions/functions-general";
import { useInView } from "react-intersection-observer";
import NoData from "../../../../partials/NoData";
import ServerError from "../../../../partials/ServerError";
import TableLoading from "../../../../partials/TableLoading";
import FetchingSpinner from "../../../../partials/spinners/FetchingSpinner";
import Loadmore from "../../../../partials/Loadmore";
import Status from "../../../../partials/Status";
import SearchBar from "../../../../partials/SearchBar";
import { FaArchive, FaEdit, FaTrash, FaTrashRestore } from "react-icons/fa";
import { 
  setIsAdd, 
  setIsArchive, 
  setIsDelete, 
  setIsRestore 
} from "../../../../store/StoreAction";

// Modals
import ModalArchive from "../../../../partials/modals/ModalArchive";
import ModalRestore from "../../../../partials/modals/ModalRestore";
import ModalDelete from "../../../../partials/modals/ModalDelete";

const DirectReportsList = ({ itemEdit, setItemEdit }) => {
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
    queryKey: ["direct-reports-list", search.current.value, store.isSearch, filterData],
    queryFn: async ({ pageParam = 1 }) =>
      await queryDataInfinite(
        ``, 
        `${apiVersion}/controllers/developers/settings/direct-report/page.php?start=${pageParam}`, 
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
          <label className="mr-2 text-sm font-medium">Status</label>
          <select
            className="p-1 border rounded"
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

      <div className="relative pt-4 rounded-md">
        {status !== "pending" && isFetching && <FetchingSpinner />}
        <table>
          <thead className="text-center bg-gray-100">
            <tr>
              <th className="py-2">#</th>
              <th>Status</th>
              <th>Employee Name</th>
              <th>Supervisor</th>
              <th>Supervisor's Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {!error && (status === "pending" || result?.pages[0]?.count === 0) && (
              <tr>
                <td colSpan="100%" className="p-10">
                  {status === "pending" ? <TableLoading cols={6} count={10} /> : <NoData />}
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
                {page?.data?.map((item, index) => (
                  <tr className="text-center border-b" key={index}>
                    <td className="py-2">{counter++}</td>
                    <td>
                      <Status text={`${item.employee_is_active == 1 ? "active" : "inactive"}`} />
                    </td>
                    <td>{item.employee_first_name} {item.employee_last_name}</td>
                    <td>
                      <span>
                        {item.employee_supervisor_first_name} {item.employee_supervisor_last_name}
                      </span>
                    </td>
                    <td>
                      <span>{item.employee_supervisor_email}</span>
                    </td>
                    <td>
                      <div className="flex items-center justify-center gap-3">
                        {/* CONDITIONAL ACTION BUTTONS */}
                        {item.employee_is_active == 1 ? (
                          <>
                            <button
                              type="button"
                              className="tooltip-action-table "
                              data-tooltip="Update Supervisor"
                              onClick={() => handleEdit(item)}
                            >
                              <FaEdit />
                            </button>
                            <button
                              type="button"
                              className="tooltip-action-table "
                              data-tooltip="Archive Record"
                              onClick={() => handleArchive(item)}
                            >
                              <FaArchive />
                            </button>
                          </>
                        ) : (
                          <>
                            <button
                              type="button"
                              className="tooltip-action-table "
                              data-tooltip="Restore Record"
                              onClick={() => handleRestore(item)}
                            >
                              <FaTrashRestore />
                            </button>
                            <button
                              type="button"
                              className="tooltip-action-table "
                              data-tooltip="Delete & Remove Supervisor"
                              onClick={() => handleDelete(item)}
                            >
                              <FaTrash />
                            </button>
                          </>
                        )}
                      </div>
                    </td>
                  </tr>
                ))}
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
            isSearchOrFilter={store.isSearch || filterData !== ""}
          />
        </div>
      </div>

      {/* MODALS RENDERED HERE */}
      {store.isArchive && itemEdit && (
        <ModalArchive
          mysqlApiArchive={`${apiVersion}/controllers/developers/employees/active.php?id=${itemEdit.employee_aid}`}
          dataItem={itemEdit}
          queryKey="direct-reports-list"
          msg="Are you sure you want to archive this employee record?"
          successMsg="Record successfully archived."
          item={`${itemEdit.employee_first_name} ${itemEdit.employee_last_name}`}
        />
      )}
      
      {store.isRestore && itemEdit && (
        <ModalRestore
          mysqlApiRestore={`${apiVersion}/controllers/developers/employees/active.php?id=${itemEdit.employee_aid}`}
          dataItem={itemEdit}
          queryKey="direct-reports-list"
          msg="Are you sure you want to restore this employee record?"
          successMsg="Record successfully restored."
          item={`${itemEdit.employee_first_name} ${itemEdit.employee_last_name}`}
        />
      )}
      
      {store.isDelete && itemEdit && (
        <ModalDelete
          mysqlApiDelete={`${apiVersion}/controllers/developers/settings/direct-report/delete.php?id=${itemEdit.employee_aid}`}
          dataItem={itemEdit}
          queryKey="direct-reports-list"
          msg={`Are you sure you want to delete and remove the assigned supervisor for ${itemEdit.employee_first_name}?`}
          successMsg="Supervisor successfully removed."
          item={`${itemEdit.employee_first_name} ${itemEdit.employee_last_name}`}
        />
      )}
    </>
  );
};

export default DirectReportsList;