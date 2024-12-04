import React from "react";
import { useLocation, Link } from "react-router-dom";

export const Breadcrumb = () => {
  const location = useLocation();
  const pathnames = location.pathname.split("/").filter((x) => x);

  return (
    <nav
      aria-label="breadcrumb"
      style={{
        position: "fixed",
        top: "50px", // Puedes ajustar este valor si es necesario
        left: 0, // Esto coloca el breadcrumb al 25% desde el lado izquierdo
        right: 0, // El valor '0' hace que se extienda hasta el borde derecho
        zIndex: 1000,
        backgroundColor: "white", // O cualquier otro color
        padding: "5px",
        boxShadow: "0 2px 4px rgba(0, 0, 0, 0.1)", // Opcional: para un borde sutil
      }}
    >
      <ol className="breadcrumb">
        <li className="breadcrumb-item">
          <Link to="/">Home</Link>
        </li>
        {pathnames.map((value, index) => {
          const to = `/${pathnames.slice(0, index + 1).join("/")}`;
          return (
            <li key={to} className="breadcrumb-item">
              <Link to={to}>
                {value.charAt(0).toUpperCase() + value.slice(1)}
              </Link>
            </li>
          );
        })}
      </ol>
    </nav>
  );
};

export default Breadcrumb;
