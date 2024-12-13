import { useEffect, useState } from "react";
import { FaEdit, FaTrash } from "react-icons/fa";
import { useNavigate } from "react-router-dom";
import carrerasService from "../../services/carrerasService.js";
import Title from "../../components/typography/title";
import "./show_carrers.css";

const ShowCarrers = () => {
   const [carreras, setCarreras] = useState([]);
   const [loading, setLoading] = useState(true);
   const [error, setError] = useState(null);
   const navigate = useNavigate();

   const loadCarreras = async () => {
      try {
         const data = await carrerasService.fetchCarreraStatus();
         if (data.length === 0) {
            setError("No se encontraron carreras.");
         } else {
            setCarreras(data);
         }
      } catch (error) {
         setError(error.message);
      } finally {
         setLoading(false);
      }
   };

   useEffect(() => {
      loadCarreras();
   }, []);

   const handleDelete = async (id) => {
      if (window.confirm("¿Estás seguro de que deseas eliminar esta carrera?")) {
         try {
            await carrerasService.deleteCarrera(id);
            setCarreras(carreras.filter(carrera => carrera.id !== id)); // Eliminar de la lista local
         } catch (error) {
            setError(error.message);
         }
      }
   };

   return (
      <div className="container mt-5">
         <div className="table title">
            <div className="row">
               <div className="">
                  <Title text={"Listado de Carreras"}></Title>
               </div>
            </div>
         </div>

         {loading && <p>Cargando carreras...</p>}
         {error && <p className="text-danger">Error: {error}</p>}

         {!loading && !error && carreras.length > 0 && (
            <table className="table table-striped table-hover">
               <thead>
                  <tr>
                     <th># ID</th>
                     <th className="nombre-columna">Nombre</th>
                     <th>Semestre</th>
                     <th>Acciones</th>
                  </tr>
               </thead>

               <tbody>
                  {carreras.map((carrera) => (
                     <tr key={carrera.id}>
                        <td>{carrera.id}</td>
                        <td>{carrera.nombre}</td>
                        <td>{carrera.nro_semestres}</td>
                        <td>
                           <Link to={`/editar-curricula/${carrera.id}`} className="edit mr-6 ml-6">
                              <FaEdit />
                           </Link>

                           <button onClick={() => handleDelete(carrera.id)} className="delete mr-6 ml-6">
                              <FaTrash />
                           </button>
                        </td>
                     </tr>
                  ))}
               </tbody>
            </table>
         )}
      </div>
   );
};

export default ShowCarrers;
