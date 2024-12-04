import { useState } from "react";
import { FaEdit, FaTrash } from "react-icons/fa";
import "./listar_personal_page.css";
import Title from "../../components/typography/title";
import { Link } from "react-router-dom";

const ListaPersonal = () => {
  // Lista de ambientes estática
  const personalA = [
    {
      id: 1,
      nombre: "Juan Pérez",
      email: "juan.perez@example.com",
      telefono: "123456781",
      estado: "activo",
      tipo_personal: "Docente",
    },
    {
      id: 2,
      nombre: "Ana González",
      email: "ana.gonzalez@universidad.com",
      telefono: "123456782",
      estado: "activo",
      tipo_personal: "Investigador",
    },
    {
      id: 3,
      nombre: "Carlos Lopez",
      email: "carlos.lopez@universidad.com",
      telefono: "123456783",
      estado: "inactivo",
      tipo_personal: "Administrador",
    },
  ];

  return (
    <div className="container mt-5">
      <div className="table title">
        <div className="row">
          <div className="">
            <Title text={"Listado de Personal"}></Title>
          </div>
        </div>
      </div>
      <table className="table table-striped table-hover ">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Estado</th>
            <th>Tipo Personal</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {personalA.map((personal) => (
            <tr key={personal.id}>
              <td>{personal.nombre}</td>
              <td>{personal.email}</td>
              <td>{personal.telefono}</td>
              <td>{personal.estado}</td>
              <td>{personal.tipo_personal}</td>
              <td>{personal.facilidades}</td>
              <td>
                <Link
                  to={`/editar-personal/${personal.id}`}
                  className="edit mr-6 ml-6"
                >
                  <FaEdit />
                </Link>
                <a href="#" className="delete mr-6 ml-6">
                  <FaTrash />
                </a>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default ListaPersonal;
