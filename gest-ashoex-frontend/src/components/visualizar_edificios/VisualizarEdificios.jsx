import { useEffect, useState } from "react";
import { obtenerEdificios } from "../../services/edificiosService";
import "./VisualizarEdificios.css";

function VisualizarEdificios() {
  const [edificios, setEdificios] = useState(null);

  useEffect(() => {
    const fetchEdificios = async () => {
      const data = await obtenerEdificios();
      setEdificios(data);
    }

    fetchEdificios();
  }, []);

  return (
    <div>
      <div><h2>Lista de edificios</h2></div>

      <div>
        <table className="tabla-edificios">
          <thead>
            <tr>
              <th>Edificio</th>
              <th>Geolocalizacion</th>
            </tr>
          </thead> 
          <tbody>
          {edificios?.map(edificio => (
            <tr key={edificio.id_edificio}>
              <td>{edificio.nombre_edificio}</td>
              <td>{edificio.geolocalizacion}</td>
            </tr>
          ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}

export default VisualizarEdificios;

