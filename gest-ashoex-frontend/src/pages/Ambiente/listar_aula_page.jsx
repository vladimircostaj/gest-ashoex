import { useState, useEffect } from "react";
import { FaEdit, FaTrash } from "react-icons/fa";
import "./listar_aula.css";
//import "./listar_ambientes.css";
import { Link } from "react-router-dom";
import axios from "axios";

const ListarAulas = () => {
  

    const [aulas, setAulas] = useState([]);
    const [ubicaciones, setUbicaciones] = useState([]);
    const [edificios, setEdificios] = useState([]);
    const api = "http://localhost:8000/api";

    const fetchAulas = async () => {
        try {
          const response = await axios.get(`${api}/aulas`);
          if (response.data.success && Array.isArray(response.data.data)) {
            setAulas(response.data.data);
          } else {
            console.error("La respuesta de la API no es un array:", response.data);
            setAulas([]);
          }
        } catch (error) {
          console.error("Error fetching aulas:", error);
          setAulas([]);
        }
      };
    
      const fetchUbicaciones = async () => {
        try {
          const response = await axios.get(`${api}/ubicaciones`);
          if (response.data.success && Array.isArray(response.data.data)) {
            setUbicaciones(response.data.data);
          } else {
            console.error("La respuesta de la API no es un array:", response.data);
            setUbicaciones([]);
          }
        } catch (error) {
          console.error("Error fetching ubicaciones:", error);
          setUbicaciones([]);
        }
      };
    
      const fetchEdificios = async () => {
        try {
          const response = await axios.get(`${api}/edificios`);
          if (response.data.success && Array.isArray(response.data.data)) {
            setEdificios(response.data.data);
          } else {
            console.error("La respuesta de la API no es un array:", response.data);
            setEdificios([]);
          }
        } catch (error) {
          console.error("Error fetching edificios:", error);
          setEdificios([]);
        }
      };
    
      useEffect(() => {
        fetchAulas();
        fetchUbicaciones();
        fetchEdificios();
      }, []);
    
      const getUbicacionNombre = (idUbicacion) => {
        const ubicacion = ubicaciones.find((ubicacion) => ubicacion.id_ubicacion === idUbicacion);
        if (ubicacion) {
          const edificio = edificios.find((edificio) => edificio.id_edificio === ubicacion.id_edificio);
          return edificio ? `${edificio.nombre_edificio} - Piso ${ubicacion.piso}` : "Desconocido";
        }
        return "Desconocido";
      };
    
      return (
        <div className="container">
            <h1>Lista de Aulas</h1>
            <table className="table table-striped table-hover">
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
                    {aulas.map((aula) => (
                        <tr key={aula.id_aula}>
                            <td>{aula.numero_aula}</td>
                            <td>{aula.capacidad}</td>
                            <td>{aula.habilitada ? "Sí" : "No"}</td>
                            <td>{getUbicacionNombre(aula.id_ubicacion)}</td>
                            <td>
                                {aula.usos.map((uso) => (
                                    <span key={uso.id_uso}>{uso.tipo_uso}</span>
                                ))}
                            </td>
                            <td>
                                {aula.facilidades.map((facilidad) => (
                                    <span key={facilidad.id_facilidad}>{facilidad.nombre_facilidad}</span>
                                ))}
                            </td>
                            <td>
                                <Link to={`/editar-ambiente/${aula.id_aula}`} className="edit mr-6 ml-6">
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
    
    export default ListarAulas;