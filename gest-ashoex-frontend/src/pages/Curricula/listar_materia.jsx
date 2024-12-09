import { useEffect, useState } from "react";
import { FaEdit, FaTrash } from "react-icons/fa";
import { Link } from "react-router-dom";
import Title from "../../components/typography/title";
import materiaService from "../../services/materiaService";

const ListarMaterias = () => {
  const [materias, setMaterias] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    async function fetchMaterias() {
      try {
        const data = await materiaService.fetchMaterias();
        setMaterias(data.data); // Actualizamos el estado de las materias con los datos obtenidos
        setLoading(false);
      } catch (err) {
        setError("Error al cargar las materias.");
        setLoading(false);
      }
    }

    fetchMaterias();
  }, []);

  const handleDelete = async (materia) => {
    const { id, nombre } = materia;

    if (window.confirm(`¿Está seguro de que desea borrar la materia ${nombre}?`)) {
      try {
        await materiaService.deleteMateria(id);
        setMaterias(materias.filter((materia) => materia.id !== id));
        setTimeout(() => {
          alert(`La materia ${nombre} ha sido borrada exitosamente.`);
        }, 0);
      } catch (error) {
        alert(`${error.message} ${nombre}.`);
      }
    }
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
                <Link
                  to={`/editar-materia/${materia.id}`}
                  className="edit mr-6 ml-6"
                >
                  <FaEdit />
                </Link>
                <a onClick={() => handleDelete(materia)} className="delete mr-6 ml-6">
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

export default ListarMaterias;
