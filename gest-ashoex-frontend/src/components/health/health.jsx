import { Outlet } from "react-router-dom";
import Breadcrumb from "../BreadCrumb/breadcrumb";
import { Toaster } from "sonner";

const HealthCheck = () => {
  return (
    <div className="md-container mt-4">
      <Toaster
        position="top-right"
        richColors
        gutter={8}
        toastOptions={{
          duration: 2000,
        }}
        style={{
          position: "absolute",
        }}
      />
      <Breadcrumb />

      <Outlet />
    </div>
  );
};

export default HealthCheck;
