import { FaEdit, FaTrash } from "react-icons/fa";
import "./show_carrers.css";
import Title from "../../components/typography/title";
import { Link } from "react-router-dom";

const ShowCarrers = () => {
   // Lista de currículas estática
   const carreras = [
      {
         id: 1,
         nombre: "Ingeniería en Informática",
         nro_semestre: "1",
      },
      {
         id: 2,
         nombre: "Ingeniería Civil",
         nro_semestre: "2",
      },
      {
         id: 3,
         nombre: "Arquitectura",
         nro_semestre: "3",
      },
   ];

   return (
      <div className="container mt-5">
         <div className="table title">
            <div className="row">
               <div className="">
                  <Title text={"Listado de Carreras"}></Title>
               </div>
            </div>
         </div>
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
                     <td>{carrera.nro_semestre}</td>
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
      </div>
   );
};

export default ShowCarrers;
