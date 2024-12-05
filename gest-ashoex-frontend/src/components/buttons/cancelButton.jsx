import React, {useState} from "react";

const CancelButton = ({ onClick, text = "Cancelar" }) => {
  const [hover, set_hover] = useState(false);

  return (
    <button
      className="btn text-white fw-bold w-100"
      type="button"
      onClick={onClick}
      style={{ backgroundColor: hover? "#6A87B5": "#789ECD", border: "none" }}
      onMouseEnter={() => set_hover(true)}
      onMouseLeave={() => set_hover(false)}
    >
      {text}
    </button>
  );
};

export default CancelButton;
