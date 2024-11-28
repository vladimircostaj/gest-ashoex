import Breadcrumb from "../Breadcrumb/breadcrumb.jsx";

const HealthCheck = () => {
  const breadcrumbItems = [{ label: "Home", path: "/" }];

  return (
    <div className="container mt-4">
      <Breadcrumb items={breadcrumbItems} />
      <h1 className="mt-4">Bienvenido a la página principal</h1>
    </div>
  );
};

export default HealthCheck;
