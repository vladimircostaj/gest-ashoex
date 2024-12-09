import { useEffect, useState } from "react";
import Title from "../../components/typography/title";
import { useParams } from "react-router-dom";
import { getPersonalById } from "../../services/personalService";

const VisualizarInformacionPersonal = () => {
  const [personal, setPersonal] = useState(null);
  const [error, setError] = useState(null);
  const [isLoading, setIsLoading] = useState(true);
  const { personalId } = useParams();

  useEffect(() => {
    const fetchData = async () => {
      setIsLoading(true);
      const response = await getPersonalById(personalId);
      response.success ? setPersonal(response.data) : setError(response);
      setIsLoading(false);
    };
    fetchData();
  }, [personalId]);

  return (
    <div className="d-flex justify-content-center align-items-center vh-100 bg-light p-3 mt-5 mt-md-0">
      <div
        className="card shadow-lg rounded-4 p-md-4"
        style={{ maxWidth: "400px", width: "100%" }}
      >
        <div className="mb-3">
          <Title text="Información Personal Académico" />
        </div>

        {isLoading ? (
          // Indicador de carga
          <div className="d-flex justify-content-center align-items-center">
            <div className="spinner-border text-primary" role="status">
              <span className="visually-hidden">Cargando...</span>
            </div>
          </div>
        ) : personal ? (
          // Mostrar datos si están disponibles
          <div className="d-flex flex-column gap-4">
            <div className="position-relative">
              <h5>Nombre:</h5>
              <p>{personal.nombre}</p>
            </div>

            <div className="position-relative">
              <h5>Teléfono:</h5>
              <p>{personal.telefono}</p>
            </div>

            <div className="position-relative">
              <h5>Email:</h5>
              <p>{personal.email}</p>
            </div>

            <div className="position-relative">
              <h5>Tipo de personal:</h5>
              <p>{personal.tipo_personal.nombre}</p>
            </div>

            <div className="position-relative">
              <h5>Estado:</h5>
              <p>{personal.estado}</p>
            </div>
          </div>
        ) : (
          // Mensaje si no se encuentra información
          <div>
            <p>{error.error.message}</p>
          </div>
        )}
      </div>
    </div>
  );
};

export default VisualizarInformacionPersonal;
