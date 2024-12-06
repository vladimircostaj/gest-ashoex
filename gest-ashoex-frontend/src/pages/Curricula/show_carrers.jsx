import { useEffect, useState } from "react";
import { FaEdit, FaTrash } from "react-icons/fa";
import carrerasService from "../../services/carrerasService.js";
import { Link } from "react-router-dom";
import Title from "../../components/typography/title";

import "./show_carrers.css";

const ShowCarrers = () => {
   const [carreras, setCarreras] = useState([]);
   const [loading, setLoading] = useState(true); // Estado para el indicador de carga
   const [error, setError] = useState(null); // Estado para errores

   // Función para cargar las carreras desde el servicio
   const loadCarreras = async () => {
      try {
         const data = await carrerasService.fetchCarreraStatus();

         // Validamos si la respuesta está vacía
         if (data.length === 0) {
            setError("No se encontraron carreras."); // Error personalizado
         } else {
            setCarreras(data);
         }
      } catch (error) {
         setError(error.message); // Capturamos el mensaje de error
      } finally {
         setLoading(false); // Quitamos el indicador de carga
      }
   };

   useEffect(() => {
      loadCarreras();
   }, []);

   return (
      <div className="container mt-5">
         <div className="table title">
            <div className="row">
               <div className="">
                  <Title text={"Listado de Carreras"}></Title>
               </div>
            </div>
         </div>

         {/* Manejamos el estado de carga */}
         {loading && <p>Cargando carreras...</p>}

         {/* Manejamos errores */}
         {error && <p className="text-danger">Error: {error}</p>}

         {/* Tabla de carreras */}
         {!loading && !error && carreras.length > 0 && (
            <table className="table table-striped table-hover">
               <thead>
                  <tr>
                     <th># ID</th>
                     <th>Nombre</th>
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

                           <a href="#" className="delete mr-6 ml-6">
                              <FaTrash />
                           </a>
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
