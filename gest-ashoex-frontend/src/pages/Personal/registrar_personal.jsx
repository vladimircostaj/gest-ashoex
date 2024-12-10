import  { useState } from 'react';
import Title from '../../components/typography/title';
import InputField from '../../components/form/inputField';
import SelectField from '../../components/form/selectField';
import SaveButton from '../../components/buttons/saveButton';
import CancelButton from '../../components/buttons/cancelButton';

const RegistrarPersonal = () => {
  const [formData, setFormData] = useState({
    nombre: '',
    correo: '',
    telefono: '',
    tipoPersonal: '', 
  });

  const [errors, setErrors] = useState({});

  const handleChange = (e) => {
    const { id, value } = e.target;
    setFormData({ ...formData, [id]: value });

    // Elimina el error si el campo no está vacío
    if (value.trim() !== '') {
      setErrors({ ...errors, [id]: '' });
    }
  };

  const handleSave = () => {
    const newErrors = {};

   
    Object.keys(formData).forEach((key) => {
   
      if (key !== 'tipoPersonal' && !formData[key].trim()) {
        newErrors[key] = 'Campo obligatorio';
      } else if (key === 'tipoPersonal' && formData[key] === '') {
        newErrors[key] = 'Campo obligatorio';
      }
    });

    setErrors(newErrors);

    if (Object.keys(newErrors).length === 0) {
      console.log('Guardado:', formData);
    }
  };

  const handleCancel = () => {
    console.log('Cancelado');
  };

  return (
    <div className="d-flex justify-content-center align-items-center vh-100 bg-light p-3">
      <div className="card shadow-lg rounded-4 p-4" style={{ maxWidth: '400px', width: '100%' }}>
        <div className="mb-3">
          <Title text="Registrar Personal Académico" />
        </div>

        <form className="d-flex flex-column gap-4" onSubmit={(e) => e.preventDefault()}>
          <div className="position-relative">
            <InputField
              label={
                <span>
                  Nombre completo: <span className="text-danger">*</span>
                </span>
              }
              id="nombre"
              placeholder="Ingrese su nombre completo"
              value={formData.nombre}
              onChange={handleChange}
              style={{
                container: { textAlign: 'left' },
                input: { width: '100%' },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: '0.75rem', top: '100%', left: '5px', height: '12px' }}>
              {errors.nombre}
            </div>
          </div>

          <div className="position-relative">
            <InputField
              label={
                <span>
                  Correo Electrónico: <span className="text-danger">*</span>
                </span>
              }
              id="correo"
              type="email"
              placeholder="Ingrese su correo"
              value={formData.correo}
              onChange={handleChange}
              style={{
                container: { textAlign: 'left' },
                input: { width: '100%' },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: '0.75rem', top: '100%', left: '5px', height: '12px' }}>
              {errors.correo}
            </div>
          </div>

          <div className="position-relative">
            <InputField
              label={
                <span>
                  Teléfono: <span className="text-danger">*</span>
                </span>
              }
              id="telefono"
              type="tel"
              placeholder="Ingrese su teléfono"
              value={formData.telefono}
              onChange={handleChange}
              style={{
                container: { textAlign: 'left' },
                input: { width: '100%' },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: '0.75rem', top: '100%', left: '5px', height: '12px' }}>
              {errors.telefono}
            </div>
          </div>

          <div className="position-relative">
            <SelectField
              label={
                <span>
                  Tipo de personal: <span className="text-danger">*</span>
                </span>
              }
              id="tipoPersonal"
              value={formData.tipoPersonal} 
              options={[
                { value: '', label: 'Seleccione una opción' },
                { value: 'docente', label: 'Docente' },
                { value: 'auxiliar', label: 'Auxiliar' },
              ]}
              onChange={handleChange} 
              style={{
                container: { textAlign: 'left' },
                select: { width: '100%' },
              }}
            />
            <div className="text-danger position-absolute" style={{ fontSize: '0.75rem', top: '100%', left: '5px', height: '12px' }}>
              {errors.tipoPersonal}
            </div>
          </div>

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