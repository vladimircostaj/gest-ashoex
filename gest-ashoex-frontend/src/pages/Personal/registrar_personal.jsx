import React from 'react';
import Title from '../../components/typography/title';
import InputField from '../../components/form/inputField';
import SelectField from '../../components/form/selectField';
import SaveButton from '../../components/buttons/saveButton';
import CancelButton from '../../components/buttons/cancelButton';

const RegistrarPersonal = () => {
  const handleCancel = () => {
    console.log('Cancelado');
  };

  const handleSave = () => {
    console.log('Guardado');
  };

  return (
    <div className="d-flex justify-content-center align-items-center vh-100 bg-light p-3">
      <div className="card shadow-lg rounded-4 p-4" style={{ maxWidth: '400px', width: '100%' }}>
        <div className="mb-3">
          <Title text="Registrar Personal Académico" />
        </div>

        <form className="d-flex flex-column gap-3">
          <InputField
            label="Nombre completo:"
            id="nombre"
            placeholder="Ingrese su nombre completo"
            style={{
              container: { textAlign: 'left' },
              input: { width: '100%' },
            }}
          />

          <InputField
            label="Correo Electrónico:"
            id="correo"
            type="email"
            placeholder="Ingrese su correo"
            style={{
              container: { textAlign: 'left' },
              input: { width: '100%' },
            }}
          />

          <InputField
            label="Teléfono:"
            id="telefono"
            type="tel"
            placeholder="Ingrese su teléfono"
            style={{
              container: { textAlign: 'left' },
              input: { width: '100%' },
            }}
          />

          <SelectField
            label="Tipo de personal:"
            id="tipo-personal"
            options={[
              { value: '', label: 'Seleccione una opción' },
              { value: 'docente', label: 'Docente' },
              { value: 'auxiliar', label: 'Auxiliar' },
            ]}
            style={{
              container: { textAlign: 'left' },
              select: { width: '100%' },
            }}
          />

          <div className="d-flex justify-content-between gap-2 mt-3">
            <CancelButton onClick={handleCancel} />
            <SaveButton onClick={handleSave} />
          </div>
        </form>
      </div>
    </div>
  );
};

export default RegistrarPersonal;
