import React from 'react';

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
        }}
      >

        <h2
          style={{
            textAlign: 'center',
            fontSize: '1.5rem',
            fontWeight: '600',
            marginBottom: '20px',
            color: '#333',
          }}
        >
          Registrar Personal Académico
        </h2>

    
        <form
          style={{
            display: 'flex',
            flexDirection: 'column',
            gap: '15px',
          }}
        >
          {[
            { label: 'Nombre completo:', id: 'nombre', type: 'text', placeholder: 'Ingrese el nombre completo' },
            { label: 'Correo Electrónico:', id: 'correo', type: 'email', placeholder: 'Ingrese el correo' },
            { label: 'Teléfono:', id: 'telefono', type: 'tel', placeholder: 'Ingrese el teléfono' },
          ].map((field) => (
            <div
              key={field.id}
              style={{
                display: 'flex',
                alignItems: 'center',
                gap: '10px',
              }}
            >
              <label
                htmlFor={field.id}
                style={{
                  fontSize: '14px',
                  fontWeight: '500',
                  color: '#555',
                  minWidth: '110px', 
                  textAlign: 'right',
                }}
              >
                {field.label}
              </label>
              <input
                id={field.id}
                type={field.type}
                placeholder={field.placeholder}
                style={{
                  flex: '1',
                  padding: '10px',
                  borderRadius: '8px',
                  border: '1px solid #ccc',
                  fontSize: '14px',
                }}
              />
            </div>
          ))}

          <div
            style={{
              display: 'flex',
              alignItems: 'center',
              gap: '10px',
            }}
          >
            <label
              htmlFor="tipo-personal"
              style={{
                fontSize: '14px',
                fontWeight: '500',
                color: '#555',
                minWidth: '110px',
                textAlign: 'right',
              }}
            >
              Tipo de personal:
            </label>
            <select
              id="tipo-personal"
              style={{
                flex: '1',
                padding: '10px',
                borderRadius: '8px',
                border: '1px solid #ccc',
                fontSize: '14px',
              }}
            >
              <option value="">Seleccione una opción</option>
              <option value="docente">Docente</option>
              <option value="administrativo">Auxiliar</option>
            </select>
          </div>

          
          <div style={{ display: 'flex', justifyContent: 'space-between', marginTop: '20px' }}>
            <button
              className="btn"
              style={{
                backgroundColor: '#007bff',
                color: '#fff',
                borderRadius: '8px',
                fontWeight: 'bold',
                padding: '10px 20px',
                flex: '1',
                marginRight: '10px',
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
                padding: '10px 20px',
                flex: '1',
                marginLeft: '10px',
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
