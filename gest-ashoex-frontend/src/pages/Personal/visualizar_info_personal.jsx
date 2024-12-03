import { useEffect, useState } from 'react';
import Title from '../../components/typography/title'
import { useParams } from 'react-router-dom';

const VisualizarInformacionPersonal = () => {
  const [personal, setPersonal] = useState(null);
  const { personalId } = useParams();

  useEffect(() => {
    // usar servicio
    setPersonal({
      Tipo_personal: 'AUXILIAR',
      telefono: '+59174677370',
      personal_academico_id: 1,
      tipo_personal_id: 2,
      nombre: 'Dr. Haleigh Treutel',
      email: 'wschamberger@example.net',
      estado: 'ACTIVO',
    });
  }, [personalId]);

  return (
    <div className="d-flex justify-content-center align-items-center vh-100 bg-light p-3">
      <div className="card shadow-lg rounded-4 p-4" style={{ maxWidth: '400px', width: '100%' }}>
        <div className="mb-3">
          <Title text="Información Personal Académico" />
        </div>

        { personal? (
          <div className="d-flex flex-column gap-4">
            <div className="position-relative">
              <h5>Nombre:</h5>
              <p>{personal.nombre}</p>
            </div>

            <div className="position-relative">
              <h5>Telefono:</h5>
              <p>{personal.telefono}</p>
            </div>

            <div className="position-relative">
              <h5>Email:</h5>
              <p>{personal.email}</p>
            </div>

            <div className="position-relative">
              <h5>Tipo de personal:</h5>
              <p>{personal.Tipo_personal}</p>
            </div>

            <div className="position-relative">
              <h5>Estado:</h5>
              <p>{personal.estado}</p>
            </div>
          </div>
        ) : (
          <div>
            Personal academico no encontrado! {/* Mostrar mensaje de la API */}
          </div>
        )}
      </div>
    </div>
  );
}

export default VisualizarInformacionPersonal;
