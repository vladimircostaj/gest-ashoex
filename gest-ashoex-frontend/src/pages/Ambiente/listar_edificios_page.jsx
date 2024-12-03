import { useState, useEffect } from "react";
import { FaEdit, FaTrash } from "react-icons/fa";
import "./listar_ambientes.css";
import Title from "../../components/typography/title";

const ListaEdificios = () => {
  // Lista de edificios base de datos
  /*const [edificios, setEdificios] = useState([]); // Estado inicial como un arreglo
  const [loading, setLoading] = useState(true); // Estado de cargando
  const [error, setError] = useState(null); // Estado para errores

  const fetchEdificios = async () => {
    try {
      const response = await fetch("http://127.0.0.1:8000/api/edificios"); // Reemplaza con tu URL real
      if (!response.ok) {
        throw new Error("Error al obtener los datos");
      }
      const { data } = await response.json(); // Extrae la propiedad `data` directamente
      setEdificios(data); // Asigna solo `data` al estado
    } catch (error) {
      console.error("Error:", error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchEdificios();
  }, []);

  if (loading) {
    return <div>Cargando datos...</div>;
  }

  if (error) {
    return <div>Error: {error}</div>;
  }
 */
  // Lista de edificios estática
  
  const edificios = [
    {
      id_edificio: 1,
      nombre_edificio: "Edificio Nuevo",
      geolocalizacion: "19.4326° N, 99.1332° W",
    },
    {
      id_edificio: 2,
      nombre_edificio: "Edificio Multiacademico",
      geolocalizacion: "34.0522° N, 118.2437° W",
    },
    {
      id_edificio: 3,
      nombre_edificio: "Edificio Memi",
      geolocalizacion: "48.8566° N, 2.3522° E",
    },
  ];

  return (
    <div className="container mt-5">
      <div className="table title">
        <div className="row">
          <div className="">
            <Title text={"Listado de Edificios"}></Title>
          </div>
        </div>
      </div>
      <table className="table table-striped table-hover">
        <thead>
          <tr>
            <th># Edif</th>
            <th>Nombre</th>
            <th>Geolocalización</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {edificios.map((edificio) => (
            <tr key={edificio.id_edificio}>
              <td>{edificio.id_edificio}</td>
              <td>{edificio.nombre_edificio}</td>
              <td>{edificio.geolocalizacion}</td>
              <td>
                <a href="#" className="edit mr-6 ml-6">
                  <FaEdit />
                </a>
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

export default ListaEdificios;