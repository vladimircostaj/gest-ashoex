import React from 'react';
import Title from '../../components/typography/title';
import InputField from '../../components/form/inputField';
import SelectField from '../../components/form/selectField';

const RegistrarPersonal = () => {
  return (
    <div
      className="d-flex justify-content-center align-items-center vh-100"
      style={{
        backgroundColor: '#f4f4f4',
        padding: '20px',
      }}
    >
      <div
        className="card shadow"
        style={{
          width: '100%',
          maxWidth: '360px',
          borderRadius: '12px',
          padding: '20px',
          backgroundColor: '#fff',
          boxShadow: '0 4px 10px rgba(0, 0, 0, 0.1)',
        }}
      >
        <Title text="Registrar Personal Académico" />

        <form
          style={{
            display: 'flex',
            flexDirection: 'column',
            gap: '15px', 
          }}
        >
        
          <InputField
            label="Nombre completo:"
            id="nombre"
            placeholder="Ingrese su nombre completo"
          />
          <InputField
            label="Correo Electrónico:"
            id="correo"
            type="email"
            placeholder="Ingrese su correo"
          />
          <InputField
            label="Teléfono:"
            id="telefono"
            type="tel"
            placeholder="Ingrese su teléfono"
          />

          <SelectField
            label="Tipo de personal:"
            id="tipo-personal"
            options={[
              { value: '', label: 'Seleccione una opción' },
              { value: 'docente', label: 'Docente' },
              { value: 'administrativo', label: 'Administrativo' },
            ]}
          />

          <div
            style={{
              display: 'flex',
              justifyContent: 'space-between',
              marginTop: '20px',
            }}
          >
            <button
              className="btn"
              style={{
                backgroundColor: '#007bff',
                color: '#fff',
                borderRadius: '8px',
                fontWeight: 'bold',
                padding: '10px 15px',
                width: '48%',
                textAlign: 'center',
              }}
              type="button"
            >
              Cancelar
            </button>
            <button
              className="btn"
              style={{
                backgroundColor: '#ff6600',
                color: '#fff',
                borderRadius: '8px',
                fontWeight: 'bold',
                padding: '10px 15px',
                width: '48%',
                textAlign: 'center',
              }}
              type="submit"
            >
              Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default RegistrarPersonal;
