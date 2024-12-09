import { useEffect, useState } from "react";
import { FaEdit, FaTrash } from "react-icons/fa";
import { Link } from "react-router-dom";
import Title from "../../components/typography/title";
import materiaService from "../../services/materiaService";

const ListarMaterias = () => {
  const [materias, setMaterias] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [mostrar, setMostrar] = useState(false); 
  const [materiaAEliminar, setMateriaAEliminar] = useState(null); 
  useEffect(() => {
    async function obtenerMaterias() {
      try {
        const data = await materiaService.fetchMaterias();
        setMaterias(data.data);
        setLoading(false);
      } catch (err) {
        setError("Error al cargar las materias.");
        setLoading(false);
      }
    }

    obtenerMaterias();
  }, []);

  const manejarEliminar = (id) => {
    setMateriaAEliminar(id);
    setMostrar(true); 
  };

  const ConfirmarEliminar = async () => {
    try {
      await materiaService.deleteMateria(materiaAEliminar); 
      setMaterias(materias.filter((materia) => materia.id !== materiaAEliminar)); 
      setMostrar(false); 
    } catch (error) {
      setError("Error al eliminar la materia.");
      setMostrar(false);
    }
  };

  const CancelarEliminar = () => {
    setMostrar(false); 
  };

  return (
    <div className="container mt-5">
      <div className="table title">
        <div className="row">
          <div className="">
            <Title text={"Listado de Materias"}></Title>
          </div>
        </div>
      </div>
      <table className="table table-striped table-hover">
        <thead>
          <tr>
            <th># ID</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Nro. Periodo Académico</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {materias.map((materia) => (
            <tr key={materia.id}>
              <td>{materia.id}</td>
              <td>{materia.codigo}</td>
              <td>{materia.nombre}</td>
              <td>{materia.tipo}</td>
              <td>{materia.nro_PeriodoAcademico}</td>
              <td>
                <Link to={`/editar-materia/${materia.id}`} className="edit mr-6 ml-6">
                  <FaEdit />
                </Link>
                <a
                  href="#"
                  className="delete mr-6 ml-6"
                  onClick={() => manejarEliminar(materia.id)}
                >
                  <FaTrash />
                </a>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      {}
      {mostrar && (
        <div className="modal" style={estilosModal.overlay}>
          <div className="modal-content" style={estilosModal.content}>
            <h4>¿Estás seguro de eliminar esta materia?</h4>
            <div>
              <button
                className="btn btn-danger mr-2"
                onClick={ConfirmarEliminar}
              >
                Confirmar
              </button>
              <button
                className="btn btn-secondary"
                onClick={CancelarEliminar}
              >
                Cancelar
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

const estilosModal = {
  overlay: {
    position: "fixed",
    top: 0,
    left: 0,
    width: "100%",
    height: "100%",
    backgroundColor: "rgba(0, 0, 0, 0.5)",
    display: "flex",
    justifyContent: "center",
    alignItems: "center",
    zIndex: 1000,
  },
  content: {
    backgroundColor: "white",
    padding: "20px",
    borderRadius: "8px",
    textAlign: "center",
    width: "300px",
  },
};

export default ListarMaterias;
