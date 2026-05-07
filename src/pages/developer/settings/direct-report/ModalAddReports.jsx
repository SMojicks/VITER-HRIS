import React from "react";
import { StoreContext } from "../../../../store/StoreContext";
import * as Yup from "yup";
import { useMutation, useQueryClient } from "@tanstack/react-query";
import { queryData } from "../../../../functions/custom-hooks/queryData";
import useQueryData from "../../../../functions/custom-hooks/useQueryData";
import { setError, setIsAdd, setMessage, setSuccess } from "../../../../store/StoreAction";
import ModalWrapperSide from "../../../../partials/modals/ModalWrapperSide";
import { FaTimes } from "react-icons/fa";
import { Formik, Form } from "formik";
import { InputSelect } from "../../../../components/form-input/FormInputs";
import ButtonSpinner from "../../../../partials/spinners/ButtonSpinner";
import MessageError from "../../../../partials/MessageError";
import { apiVersion } from "../../../../functions/functions-general";

const ModalAddReports = ({ itemEdit }) => {
  const { store, dispatch } = React.useContext(StoreContext);
  const queryClient = useQueryClient();

  // Fetch employees for the dropdown
  const { data: empData, isLoading: empLoading } = useQueryData(
    `${apiVersion}/controllers/developers/employees/read.php`, 
    "get",
    "employees"
  );

  const mutation = useMutation({
    mutationFn: (values) =>
      queryData(
        `${apiVersion}/controllers/developers/settings/direct-report/update.php`,
        "put",
        values
      ),
    onSuccess: (data) => {
      // FIX: Invalidate both caches to trigger table re-renders for both pages!
      queryClient.invalidateQueries({ queryKey: ["employees"] });
      queryClient.invalidateQueries({ queryKey: ["direct-reports-list"] });

      if (data.success) {
        dispatch(setSuccess(true));
        dispatch(setMessage(`Supervisor successfully assigned.`));
        dispatch(setIsAdd(false));
      } else {
        dispatch(setError(true));
        dispatch(setMessage(data.error));
      }
    },
    onError: (error) => {
        dispatch(setError(true));
        dispatch(setMessage("Failed to connect to the server. Please check your API path."));
    }
  });

  const initVal = {
    subordinate_id: itemEdit ? itemEdit.employee_aid : "",
    supervisor_id: itemEdit ? (itemEdit.employee_supervisor_id || "") : "",
  };

  const yupSchema = Yup.object({
    subordinate_id: Yup.string().required("Subordinate is required."),
    supervisor_id: Yup.string()
      .required("Supervisor is required.")
      .notOneOf([Yup.ref('subordinate_id')], "An employee cannot be their own supervisor."),
  });

  const handleClose = () => {
    dispatch(setIsAdd(false));
  };

  React.useEffect(() => {
    dispatch(setError(false));
  }, [dispatch]);

  return (
    <ModalWrapperSide handleClose={handleClose} className="transition-all ease-in-out transform duration-200">
      <div className="modal-header relative mb-4">
        <h3 className="text-dark text-sm">Assign Supervisor</h3>
        <button type="button" onClick={handleClose} className="absolute top-0 right-4">
          <FaTimes />
        </button>
      </div>
      <div className="modal-body">
        <Formik
          initialValues={initVal}
          validationSchema={yupSchema}
          onSubmit={async (values) => {
            dispatch(setError(false));
            mutation.mutate(values);
          }}
        >
          {(props) => (
            <Form className="h-full">
              <div className="modal-form-container">
                <div className="modal-container">
                  <div className="relative mb-6">
                    <InputSelect
                      label="Select Subordinate (Employee)"
                      name="subordinate_id"
                      disabled={mutation.isPending || empLoading || itemEdit !== null} 
                    >
                      <option value="" hidden>Select Employee</option>
                      {empData?.data?.map((emp) => (
                        <option key={`sub_${emp.employee_aid}`} value={emp.employee_aid}>
                          {emp.employee_first_name} {emp.employee_last_name}
                        </option>
                      ))}
                    </InputSelect>
                  </div>

                  <div className="relative mb-6">
                    <InputSelect
                      label="Select Supervisor"
                      name="supervisor_id"
                      disabled={mutation.isPending || empLoading}
                    >
                      <option value="" hidden>Select Supervisor</option>
                      {empData?.data?.map((emp) => (
                        <option key={`sup_${emp.employee_aid}`} value={emp.employee_aid}>
                          {emp.employee_first_name} {emp.employee_last_name}
                        </option>
                      ))}
                    </InputSelect>
                  </div>

                  {store.error && <MessageError />}
                </div>

                <div className="modal-action">
                  <button
                    type="submit"
                    disabled={mutation.isPending || !props.dirty}
                    className="btn-modal-submit"
                  >
                    {mutation.isPending ? <ButtonSpinner /> : "Add"}
                  </button>
                  <button
                    type="button"
                    className="btn-modal-cancel"
                    onClick={handleClose}
                    disabled={mutation.isPending}
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </Form>
          )}
        </Formik>
      </div>
    </ModalWrapperSide>
  );
};

export default ModalAddReports;