import { useState } from "react";
import { FaEdit, FaTrash } from "react-icons/fa";
import "./listar_ambientes.css";
import Title from "../../components/typography/title";
import { Link } from "react-router-dom";

const ListaAmbientes = () => {
  // Lista de ambientes estática
  const ambientes = [
    {
      id: 1,
      aula: "1",
      capacidad: 50,
      habilitada: "Si",
      ubicacion: "Salon",
      uso: "Clase",
      facilidades: "Proyector",
    },
    {
      id: 2,
      aula: "2",
      capacidad: 30,
      habilitada: "No",
      ubicacion: "Laboratorio",
      uso: "Practica",
      facilidades: "Computadoras",
    },
    {
      id: 3,
      aula: "3",
      capacidad: 40,
      habilitada: "Si",
      ubicacion: "Auditorio",
      uso: "Conferencia",
      facilidades: "Audio, Proyector",
    },
  ];

  return (
    <div className="container mt-md-5">
      <div className="table title">
        <div className="row">
          <div className="">
            <Title text={"Listado de Ambientes"}></Title>
          </div>
        </div>
      </div>
      <table className="table table-striped table-hover ">
        <thead>
          <tr>
            <th># Aula</th>
            <th>Capacidad</th>
            <th>Habilitada</th>
            <th>Ubicación</th>
            <th>Uso</th>
            <th>Facilidades</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {ambientes.map((ambiente) => (
            <tr key={ambiente.id}>
              <td>{ambiente.aula}</td>
              <td>{ambiente.capacidad}</td>
              <td>{ambiente.habilitada}</td>
              <td>{ambiente.ubicacion}</td>
              <td>{ambiente.uso}</td>
              <td>{ambiente.facilidades}</td>
              <td>
                <Link
                  to={`/editar-ambiente/${ambiente.id}`}
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

export default ListaAmbientes;
