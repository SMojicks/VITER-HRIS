import React, { Children } from "react";
import Header from "../../partials/Header";
import { navList } from "./nav-function";
import Navigation from "../../partials/Navigation";

const Layout = ({ children, menu = "", submenu = "" }) => {
  return (
    <>
      {/* Header */}
      <Header />
      {/* Navigation */}
      <Navigation menu={menu} submenu={submenu} navigationList={navList} />
      {/* Body */}
      <div className="wrapper">{children}</div>

      {/* Footer */}
    </>
  );
};

export default Layout;
