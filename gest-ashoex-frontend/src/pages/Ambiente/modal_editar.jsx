import React from "react";
import Modal from "react-modal";
import FormCard from "../../components/form/formCard";
import InputField from "../../components/form/inputField";
import SaveButton from "../../components/buttons/saveButton";
import CancelButton from "../../components/buttons/cancelButton";

const EditarModal = ({
  isOpen,
  onRequestClose,
  title,
  formData,
  handleChange,
  handleSave,
  error,
}) => {
  return (
    <Modal
      isOpen={isOpen}
      onRequestClose={onRequestClose}
      contentLabel="Editar Modal"
      className="modal-content"
      overlayClassName="modal-overlay"
    >
      <FormCard>
        <div className="mb-3 text-center">
          <h2>{title}</h2>
        </div>
        <form className="d-flex flex-column gap-3">
          <InputField
            label="Nombre de Facilidad:"
            id="nombre_facilidad"
            name="nombre_facilidad"
            placeholder="Ingrese el nombre de la facilidad"
            value={formData.nombre_facilidad}
            onChange={handleChange} 
          />
          {error && <div className="text-danger">{error}</div>}

          <div className="d-flex justify-content-between gap-2 mt-3">
            <CancelButton onClick={onRequestClose} />
            <SaveButton onClick={handleSave} />
          </div>
        </form>
      </FormCard>
    </Modal>
  );
};

export default EditarModal;