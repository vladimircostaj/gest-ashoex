import { Link } from "react-router-dom";
import Title from "../../components/typography/title";
import { FaEdit, FaTrash } from "react-icons/fa";
import { useEffect, useState } from "react";
import { getListaPersonal } from "../../services/ListaPersonalService";

/* const personalData = [
  {
    id: 1,
    name: "Juan Perez",
    email: "juan@gmail.com",
    telefono: "12345678",
    estado: "Activo",
    tipoPersonal: "Titular",
  },
  {
    id: 2,
    name: "Pedro Montes",
    email: "pedro@gmail.com",
    telefono: "12345678",
    estado: "Activo",
    tipoPersonal: "Auxiliar",
  },
  {
    id: 3,
    name: "Maria Lopez",
    email: "maria@gmail.com",
    telefono: "12345678",
    estado: "Activo",
    tipoPersonal: "Auxiliar",
  },
  {
    id: 4,
    name: "Jose Perez",
    email: "jose@gmail.com",
    telefono: "12345678",
    estado: "Activo",
    tipoPersonal: "Auxiliar",
  },
  {
    id: 5,
    name: "Ana Perez",
    email: "ana@gmail.com",
    telefono: "12345678",
    estado: "Activo",
    tipoPersonal: "Auxiliar",
  },
  {
    id: 6,
    name: "Luis Montalvo",
    email: "luis@gmail.com",
    telefono: "12345678",
    estado: "Activo",
    tipoPersonal: "Auxiliar",
  },
  {
    id: 7,
    name: "Carlos Montesino",
    email: "carlos@gmail.com",
    telefono: "12345678",
    estado: "Activo",
    tipoPersonal: "Auxiliar",
  },
  {
    id: 8,
    name: "Rosa Rodriguez",
    email: "rosa@gmail.com",
    telefono: "12345678",
    estado: "Activo",
    tipoPersonal: "Auxiliar",
  },
  {
    id: 9,
    name: "Luisa Peralta",
    email: "luisa@gmail.com",
    telefono: "12345678",
    estado: "Activo",
    tipoPersonal: "Auxiliar",
  },
  {
    id: 10,
    name: "Sofia Iglesias",
    email: "sofia@gmail.com",
    telefono: "12345678",
    estado: "Activo",
    tipoPersonal: "Auxiliar",
  },
]; */

export const ListarPersonal = () => {
  const [personal, setPersonal] = useState([]);

  useEffect(() => {
    loadPersonal();
  }, []);

  const loadPersonal = async () => {
    const personal = await getListaPersonal();

    setPersonal(personal.data);
  };

  return (
    <div className="container mt-5">
      <div className="table title">
        <div className="row">
          <div className="mt-2">
            <Title text={"Listado de Personal"}></Title>
          </div>
        </div>
      </div>
      <div className="table-responsive">
        <table className="table table-striped table-hover w-auto">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Estado</th>
              <th>Tipo de personal</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {personal.map((personal, index) => (
              <tr key={index}>
                <td>{personal.nombre}</td>
                <td>{personal.email}</td>
                <td>{personal.telefono}</td>
                <td>{personal.estado}</td>
                <td>
                  {personal.tipo_personal_id === 1 ? "Titular" : "Auxiliar"}
                </td>
                <td>
                  <Link
                    to={`/editar-personal/${personal.personal_academico_id}`}
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
    </div>
  );
};
