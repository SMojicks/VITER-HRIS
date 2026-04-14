export const urlPath = "http://localhost/react-vite/viter-hris";
export const devNavUrl = "";
export const devApiUrl = urlPath + "/rest";
export const apiVersion = "/v1";

// ROLES VARIABLE
export const urlDeveloper = "developer";

//DEV API KEY
export const devKey = "123devkey";

export const isEmptyItem = (item, x = "") => {
  let result = x;

  if (typeof item !== "undefined" && item !== "") {
    result = item;
  }
  return result;
};
