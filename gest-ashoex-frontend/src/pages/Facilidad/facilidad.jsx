import { useEffect, useState } from "react";
import "./facilidad.css"; // Importa el archivo de estilos

const Facilidad = () => {
  const [facilidades, setFacilidades] = useState([]);

  useEffect(() => {
    const fetchFacilidades = async () => {
      try {
        const response = await fetch("http://localhost:8000/api/facilidades/");
        const data = await response.json();
        setFacilidades(data);
      } catch (error) {
        console.error(error);
      }
    };
    fetchFacilidades();
  }, []);

  return (
    <div className="facilidad-container">
      <table className="facilidad-table">
        <thead>
          <tr>
            <th>Nombre Facilidad</th>
            <th>Ambiente asociado</th>
          </tr>
        </thead>
        <tbody>
          {facilidades.map((facilidad) => (
            <tr key={facilidad.id_facilidad}>
              <td>{facilidad.nombre_facilidad}</td>
              <td>{facilidad.id_aula}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Facilidad;
