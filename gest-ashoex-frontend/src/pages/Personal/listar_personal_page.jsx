import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import Title from "../../components/typography/title";
import { FaEdit, FaEye } from "react-icons/fa";
import PersonOffIcon from "@mui/icons-material/PersonOff"; 
import { getListaPersonal} from "../../services/ListaPersonalService";
import {darBaja} from "../../services/personalService"
import { toast } from "sonner";

export const ListarPersonal = ({ setInactiveUsers }) => {
  const [personal, setPersonal] = useState([]);
  const [showModal, setShowModal] = useState(false);
  const [selectedPersonal, setSelectedPersonal] = useState(null);

  useEffect(() => {
    loadPersonal();
  },[]);

  const loadPersonal = async () => {
    const response = await getListaPersonal();
    console.log(response);
    const personalActivos = response.data.filter(persona => persona.estado === "ACTIVO"); 
    setPersonal(personalActivos); 
  };

  const handleDarDeBaja = async () => {
    if (selectedPersonal) {
      const result = await darBaja(selectedPersonal.personal_academico_id);
      toast.success("Se dio de baja");
      if (result.success) {
        loadPersonal(); 
        setShowModal(false); 
      } else {
        alert(result.message || 'Error al dar de baja.');
      }
    }
  };

  return (
    <div className="container mt-md-5">
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
                <td className="d-flex justify-content-start align-items-center gap-3">
                  <Link
                    to={`/visualizar-personal/${personal.personal_academico_id}`}
                  >
                    <FaEye />
                  </Link>
                  <Link
                    to={`/editar-personal/${personal.personal_academico_id}`}
                  >
                    <FaEdit />
                  </Link>
                  <button
                    className="btn text-danger m-0 p-0"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    onClick={() => {
                      setShowModal(true);
                      setSelectedPersonal(personal); 
                    }}
                  >
                    <PersonOffIcon />
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
                  ¿Estas seguro de dar de baja a este registro?
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
                <button
                  type="button"
                  className="btn btn-primary"
                  onClick={handleDarDeBaja}
                >
                  Sí
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};
