import React, { useState } from "react";

const ListaAmbientes = () => {
  const [ambientes, setAmbientes] = useState([
    {
      numero_aula: "101",
      capacidad: 50,
      habilitada: true,
      id_ubicacion: "1",
      id_uso: "2",
      facilidades: ["Proyector", "Pizarra"],
    },
    {
      numero_aula: "102",
      capacidad: 30,
      habilitada: false,
      id_ubicacion: "2",
      id_uso: "1",
      facilidades: ["Ventilador"],
    },
    {
      numero_aula: "103",
      capacidad: 100,
      habilitada: true,
      id_ubicacion: "3",
      id_uso: "3",
      facilidades: ["Aire acondicionado", "Micrófono"],
    },
  ]);

  return (
    <div className="">
      <h1 className="mb-4 text-center">Lista de Ambientes</h1>
      <table className="table table-hover border">
        <thead>
          <tr className="table-secondary text-center">
            <th scope="col">#</th>
            <th scope="col">Número de Aula</th>
            <th scope="col">Capacidad</th>
            <th scope="col">Habilitada</th>
            <th scope="col">Ubicación</th>
            <th scope="col">Uso</th>
            <th scope="col">Facilidades</th>
          </tr>
        </thead>
        <tbody>
          {ambientes.length > 0 ? (
            ambientes.map((ambiente, index) => (
              <tr key={index} className="align-middle">
                <th scope="row" className="text-center">
                  {index + 1}
                </th>
                <td className="text-center">{ambiente.numero_aula}</td>
                <td className="text-center">{ambiente.capacidad}</td>
                <td className="text-center">
                  {ambiente.habilitada ? (
                    <span className="badge bg-success">Habilitada</span>
                  ) : (
                    <span className="badge bg-danger">No habilitada</span>
                  )}
                </td>
                <td className="text-center">{ambiente.id_ubicacion}</td>
                <td className="text-center">{ambiente.id_uso}</td>
                <td>{ambiente.facilidades.join(", ") || "Ninguna"}</td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="7" className="text-center text-muted">
                No hay ambientes registrados.
              </td>
            </tr>
          )}
        </tbody>
      </table>
    </div>
  );
};

export default ListaAmbientes;
