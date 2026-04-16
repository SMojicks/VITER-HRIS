import React from "react";
import { FaPlus } from "react-icons/fa";
import Layout from "../Layout";
import { StoreContext } from "../../../store/StoreContext";
import { setIsAdd } from "../../../store/StoreAction";
import EmployeesList from "./EmployeesList";

const Employees = () => {
  const { store, dispatch } = React.useContext(StoreContext);
  const [itemEdit, setItemEdit] = React.useState(null);
  const handleAdd = () => {
    dispatch(setIsAdd(true));
    setItemEdit(null);
  };

  return (
    <>
      <Layout menu="employees">
        {/* page header */}
        <div className="flex items-center w-full justify-between">
          <h1>Employees</h1>
          <div>
            <button
              type="button"
              className="flex items=center gap-1 hover:underline"
              onClick={handleAdd}
            >
              <FaPlus className="text-primary" />
              Add
            </button>
          </div>
        </div>
        {/* page content */}
        <div>
          <EmployeesList itemEdit={itemEdit} setItemEdit={setItemEdit} />
        </div>
      </Layout>
      {/* {store.isAdd && <ModalAddRoles itemEdit={itemEdit} />} */}
    </>
  );
};

export default Employees;
