import React from "react";
import { StoreContext } from "../../../store/StoreContext";
import { setIsView } from "../../../store/StoreAction";
import ModalWrapperCenter from "../../../partials/modals/ModalWrapperCenter";

const ModalViewMemo = ({ itemEdit }) => {
  const { dispatch } = React.useContext(StoreContext);

  const handleClose = () => {
    dispatch(setIsView(false));
  };

  return (
    <ModalWrapperCenter handleClose={handleClose}>
      
      <div className="modal-main bg-white w-[750px] max-w-[95vw] h-[90vh] flex flex-col rounded-md shadow-md p-8">
        
        {/* Memo Contents */}
        <div className="flex-1 overflow-y-auto pr-2 flex flex-col gap-3">

            <div className="grid grid-cols-[100px_1fr] items-center text-xs">
            <span className="font-bold text-gray-700">To:</span>
            <span className="text-gray-700">{itemEdit?.memo_to}</span>
          </div>

            <div className="grid grid-cols-[100px_1fr] items-center text-xs">
            <span className="font-bold text-gray-700">From:</span>
            <span className="text-gray-700">{itemEdit?.memo_from}</span>
          </div>
          
          <div className="grid grid-cols-[100px_1fr] items-center text-xs">
            <span className="font-bold text-gray-700">Date:</span>
            <span className="text-gray-700">{itemEdit?.memo_date}</span>
          </div>
          
          
          <div className="grid grid-cols-[100px_1fr] items-center text-xs">
            <span className="font-bold text-gray-700">Category:</span>
            <span className="badge bg-gray-100 text-gray-700 w-max px-2 py-1 rounded">
              {itemEdit?.memo_category}
            </span>
          </div>

          {/* Divider and Main Text */}
          <div className="mt-4 pt-4 border-t border-gray-200">
            <p className="whitespace-pre-wrap leading-relaxed text-gray-700 text-xs">
              {itemEdit?.memo_text}
            </p>
          </div>

        </div>
        <div className="mt-6 pt-4 flex justify-end">
          <button
            type="button"
            className="btn-modal-cancel w-fit bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-md transition-colors"
            onClick={handleClose}
          >
            Close
          </button>
        </div>

      </div>
    </ModalWrapperCenter>
  );
};

export default ModalViewMemo;