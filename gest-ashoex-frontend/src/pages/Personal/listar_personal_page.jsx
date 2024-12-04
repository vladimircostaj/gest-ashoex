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
  const [showModal, setShowModal] = useState(false);

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
            <Title className="mb-0" text={"Listado de Personal"}></Title>
          </div>
        </div>
      </div>
      <div className="table-responsive">
        <table className="table table-striped table-hover w-auto">
          <thead>
            <tr>
              <th>#</th>
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
                <td>{index + 1}</td>
                <td>{personal.nombre}</td>
                <td>{personal.email}</td>
                <td>{personal.telefono}</td>
                <td className="text-lowercase">{personal.estado}</td>
                <td>
                  {personal.tipo_personal_id === 1 ? "Titular" : "Auxiliar"}
                </td>
                <td className="d-flex justify-content-start align-items-center">
                  <Link
                    to={`/editar-personal/${personal.personal_academico_id}`}
                    className="edit mr-6 ml-6"
                  >
                    <FaEdit />
                  </Link>
                  <button
                    className="btn text-danger my-auto"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    onClick={() => setShowModal(true)}
                  >
                    <FaTrash />
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>

        <div
          className={`modal fade show ${showModal ? "show d-block" : ""}`}
          id="exampleModal"
          tabIndex="-1"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div className="modal-dialog modal-dialog-centered">
            <div className="modal-content">
              <div className="modal-header">
                <h1 className="modal-title fs-5" id="exampleModalLabel">
                  ¿Esta seguro de eliminar el registro?
                </h1>
                <button
                  type="button"
                  className="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                  onClick={() => setShowModal(false)}
                ></button>
              </div>
              <div className="modal-footer">
                <button
                  type="button"
                  className="btn btn-secondary"
                  data-bs-dismiss="modal"
                  onClick={() => setShowModal(false)}
                >
                  No
                </button>
                <button type="button" className="btn btn-primary">
                  Si
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};
