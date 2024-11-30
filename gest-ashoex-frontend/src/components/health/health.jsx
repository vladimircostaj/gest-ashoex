import { Outlet } from "react-router-dom";
import Breadcrumb from "../BreadCrumb/breadcrumb";

const HealthCheck = () => {
  return (
    <div className="container mt-4 ">
      <Breadcrumb />
      <Outlet />
    </div>
  );
};

export default HealthCheck;
