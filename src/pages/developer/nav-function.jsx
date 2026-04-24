import { FaClipboardList, FaCogs, FaUsers } from "react-icons/fa";
import { MdDashboard } from "react-icons/md";
import { devNavUrl, urlDeveloper } from "../../functions/functions-general";

export const navList = [
  {
    label: "Dashboard",
    icon: <MdDashboard />,
    menu: "dashboard",
    path: `${devNavUrl}/${urlDeveloper}/dashboard`,
    submenu: "",
  },
  {
    label: "Employees",
    icon: <FaUsers />,
    menu: "employees",
    path: `${devNavUrl}/${urlDeveloper}/employees`,
    submenu: "",
  },
  {
    label: "Settings",
    icon: <FaCogs />,
    menu: "settings",
    submenu: "",
    subNavList: [
      {
        label: "Role",
        path: `${devNavUrl}/${urlDeveloper}/settings/role`,
      },
      {
        label: "users",
        path: `${devNavUrl}/${urlDeveloper}/settings/users`,
      },
      {
        label: "department",
        path: `${devNavUrl}/${urlDeveloper}/settings/department`,
      },
      {
        label: "notification",
        path: `${devNavUrl}/${urlDeveloper}/settings/notification`,
      },
    ],
  },
  {
    label: "Memo",
    path: `${devNavUrl}/${urlDeveloper}/memo`,
    icon: <FaClipboardList />,
  },
];
