import React from "react";
import Layout from "../../Layout";
import DirectReportsList from "./DirectReportsList";
import { StoreContext } from "../../../../store/StoreContext";
import { setIsAdd } from "../../../../store/StoreAction";
import { FaPlus } from "react-icons/fa";
import ModalAddReports from "./ModalAddReports";

const DirectReports = () => {
  const { store, dispatch } = React.useContext(StoreContext);
  const [itemEdit, setItemEdit] = React.useState(null);
  
  const handleAdd = () => {
    dispatch(setIsAdd(true));
    setItemEdit(null);
  };

  return (
    <>
      <Layout menu="settings" submenu="direct-reports">
        <div className="flex items-center w-full justify-between">
          <h1>Direct Reports</h1>
          <div>
            <button
              type="button"
              className="flex items-center gap-1 hover:underline"
              onClick={handleAdd}
            >
              <FaPlus className="text-primary" />
              Assign Supervisor
            </button>
          </div>
        </div>
        <div>
          <DirectReportsList itemEdit={itemEdit} setItemEdit={setItemEdit} />
        </div>
      </Layout>
      {store.isAdd && <ModalAddReports itemEdit={itemEdit} />}
    </>
  );
};

export default DirectReports;