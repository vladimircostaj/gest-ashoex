import React from "react";

const SaveButton = ({ onClick, text = "Guardar" }) => {
  return (
    <button
      className="btn text-white fw-bold w-100"
      type="button"
      onClick={onClick}
      style={{ backgroundColor: "#FF995B", border: "none" }}
    >
      {text}
    </button>
  );
};

export default SaveButton;
