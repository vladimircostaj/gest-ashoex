import { FaEdit, FaTrash } from "react-icons/fa";
import "./listar_ambientes.css";
import Title from "../../components/typography/title";

const ListaEdificios = () => {
  // Lista de edificios estática
  const edificios = [
    {
      id: 1,
      nombre: "Edificio Nuevo",
      geolocalizacion: "19.4326° N, 99.1332° W",
    },
    {
      id: 2,
      nombre: "Edificio Multiacademico",
      geolocalizacion: "34.0522° N, 118.2437° W",
    },
    {
      id: 3,
      nombre: "Edificio Memi",
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
            <tr key={edificio.id}>
              <td>{edificio.id}</td>
              <td>{edificio.nombre}</td>
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