import { useState, useEffect } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import { useParams, useNavigate } from "react-router-dom";
import "./registrar_personalAcademico.css";

const EditarPersonalAcademico = () => {
  const { personalId } = useParams(); 
  const navigate = useNavigate(); 

  const [formData, setFormData] = useState({
    nombre: "",
    email: "",
    telefono: "",
    estado: "",
    tipo_personal_id: "",
  });

  const [disponibles, setDisponibles] = useState({
    tipos: [],
  });

  // Simulación de datos de ejemplo
  useEffect(() => {
    const mockPersonal = {
      id: personalId || 1,
      nombre: "Juan Pérez",
      email: "juan.perez@example.com",
      telefono: "123456789",
      estado: "activo",
      tipo_personal_id: 2,
    };

    const mockTipos = [
      { id: 1, nombre: "Docente" },
      { id: 2, nombre: "Investigador" },
      { id: 3, nombre: "Administrador" },
    ];

    // Simula la "carga" de datos
    setTimeout(() => {
      setFormData(mockPersonal);
      setDisponibles({ tipos: mockTipos });
    }, 500); // Simula un retraso de carga
  }, [personalId]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const handleCancel = () => {
    alert("Cancelando edición. Redirigiendo...");
    navigate("/personal-academico"); // Simula la redirección a la lista
  };

  const handleSave = () => {
    alert("Datos guardados:\n" + JSON.stringify(formData, null, 2));
    navigate("/personal-academico"); // Simula la redirección a la lista
  };

  return (
    <div className="form-container">
      <div className="card form-card">
        <div className="mb-3 text-center">
          <Title text="Editar Personal Académico" />
        </div>

        <form className="d-flex flex-column gap-3">
          <InputField
            label="Nombre:"
            id="nombre"
            placeholder="Ingrese el nombre"
            name="nombre"
            value={formData.nombre}
            onChange={handleChange}
          />

          <InputField
            label="Correo:"
            id="email"
            type="email"
            placeholder="Ingrese el correo"
            name="email"
            value={formData.email}
            onChange={handleChange}
          />

          <InputField
            label="Teléfono:"
            id="telefono"
            placeholder="Ingrese el teléfono"
            name="telefono"
            value={formData.telefono}
            onChange={handleChange}
          />

          <SelectField
            label="Tipo de Personal:"
            id="tipo_personal_id"
            name="tipo_personal_id"
            options={[
              { value: "", label: "Seleccione un tipo de personal" },
              ...disponibles.tipos.map((tipo) => ({
                value: tipo.id,
                label: tipo.nombre,
              })),
            ]}
            value={formData.tipo_personal_id}
            onChange={handleChange}
          />

          <SelectField
            label="Estado:"
            id="estado"
            name="estado"
            options={[
              { value: "activo", label: "Activo" },
              { value: "inactivo", label: "Inactivo" },
            ]}
            value={formData.estado}
            onChange={handleChange}
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

export default EditarPersonalAcademico;
