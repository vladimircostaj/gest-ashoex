import { useState, useEffect } from "react"; 
import Title from "../../components/typography/title";
import InputField from "../../components/form/inputField";
import SelectField from "../../components/form/selectField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";
import { useParams, useNavigate } from "react-router-dom";
import { getPersonalById, updatePersonal } from "../../services/EditarPersonal";
import { getTiposPersonal } from "../../services/ListarTiposPersonal";
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

  const [errors, setErrors] = useState({});

  useEffect(() => {
    const loadData = async () => {
      try {
        const [personal, tipos] = await Promise.all([
          getPersonalById(personalId),
          getTiposPersonal(),
        ]);

        setFormData(personal);
        setDisponibles({ tipos });
      } catch (error) {
        console.error("Error al cargar los datos:", error);
        alert("Ocurrió un error al cargar los datos.");
      }
    };

    loadData();
  }, [personalId]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
    setErrors({ ...errors, [name]: "" }); // Limpiar errores al cambiar valores
  };

  const validateForm = () => {
    const newErrors = {};
    if (!formData.nombre.trim()) newErrors.nombre = "El nombre es obligatorio.";
    if (!formData.email.trim()) newErrors.email = "El correo es obligatorio.";
    if (!formData.telefono.trim()) newErrors.telefono = "El teléfono es obligatorio.";
    if (!formData.estado) newErrors.estado = "Debe seleccionar un estado.";
    if (!formData.tipo_personal_id) newErrors.tipo_personal_id = "Debe seleccionar un tipo de personal.";

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleCancel = () => {
    navigate("/personal-academico");
  };

  const handleSave = async () => {
    if (!validateForm()) return;

    try {
      await updatePersonal(personalId, formData);
      alert("Datos actualizados exitosamente.");
      navigate("/personal-academico");
    } catch (error) {
      console.error("Error al guardar los datos:", error);
      alert("Ocurrió un error al guardar los datos.");
    }
  };

  return (
    <div className="form-container mt-md-5">
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
            error={errors.nombre}
          />

          <InputField
            label="Correo:"
            id="email"
            type="email"
            placeholder="Ingrese el correo"
            name="email"
            value={formData.email}
            onChange={handleChange}
            error={errors.email}
          />

          <InputField
            label="Teléfono:"
            id="telefono"
            placeholder="Ingrese el teléfono"
            name="telefono"
            value={formData.telefono}
            onChange={handleChange}
            error={errors.telefono}
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
            error={errors.tipo_personal_id}
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
            error={errors.estado}
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
