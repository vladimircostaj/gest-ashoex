import { useState, useEffect } from "react";
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import { useParams } from "react-router-dom";
import "./registrar_personalAcademico.css"; 

const EditarPersonalAcademico = () => {
  const { personalId } = useParams(); 

  const [formData, setFormData] = useState({
    nombre: "",
    apellido: "",
    correo: "",
    id_departamento: "",
    id_rol: "",
  });

  const [disponibles, setDisponibles] = useState({
    departamentos: [],
    roles: [],
  });

  // Simulando una lista de personal académico
  const personalAcademico = [
    {
      id: "1",
      nombre: "Juan",
      apellido: "Pérez",
      correo: "juan.perez@universidad.com",
      id_departamento: "1",
      id_rol: "1",
    },
    {
      id: "2",
      nombre: "Ana",
      apellido: "González",
      correo: "ana.gonzalez@universidad.com",
      id_departamento: "2",
      id_rol: "2",
    },
    {
      id: "3",
      nombre: "Carlos",
      apellido: "López",
      correo: "carlos.lopez@universidad.com",
      id_departamento: "1",
      id_rol: "3",
    },
  ];

  // Simulando la carga de opciones disponibles
  const dataDisponibles = {
    departamentos: [
      { id: "1", nombre: "Ciencias Sociales" },
      { id: "2", nombre: "Ingeniería" },
    ],
    roles: [
      { id: "1", nombre: "Profesor" },
      { id: "2", nombre: "Investigador" },
      { id: "3", nombre: "Asistente" },
    ],
  };

  // Cargar los datos del personal académico cuando se carga el componente
  useEffect(() => {
    const personal = personalAcademico.find((per) => per.id === personalId);

    if (personal) {
      setFormData(personal);
    }
    setDisponibles(dataDisponibles);
  }, [personalId]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleCancel = () => {
    console.log("Edición cancelada");
  };

  const handleSave = () => {
    console.log("Datos guardados:", formData);
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
            name={"nombre"}
            value={formData.nombre}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              input: { width: "100%" },
            }}
          />

          <InputField
            label="Apellido:"
            id="apellido"
            placeholder="Ingrese el apellido"
            name={"apellido"}
            value={formData.apellido}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              input: { width: "100%" },
            }}
          />

          <InputField
            label="Correo:"
            id="correo"
            type="email"
            name={"correo"}
            placeholder="Ingrese el correo"
            value={formData.correo}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              input: { width: "100%" },
            }}
          />

          <SelectField
            label="Departamento:"
            id="id_departamento"
            name={"id_departamento"}
            options={[
              { value: "", label: "Seleccione un departamento" },
              ...disponibles.departamentos.map((departamento) => ({
                value: departamento.id,
                label: departamento.nombre,
              })),
            ]}
            value={formData.id_departamento}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              select: { width: "100%" },
            }}
          />

          <SelectField
            label="Rol:"
            id="id_rol"
            name={"id_rol"}
            options={[
              { value: "", label: "Seleccione un rol" },
              ...disponibles.roles.map((rol) => ({
                value: rol.id,
                label: rol.nombre,
              })),
            ]}
            value={formData.id_rol}
            onChange={handleChange}
            style={{
              container: { textAlign: "left" },
              select: { width: "100%" },
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

export default EditarPersonalAcademico;