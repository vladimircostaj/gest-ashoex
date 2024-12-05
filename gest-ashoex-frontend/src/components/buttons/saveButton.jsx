import React, {useState} from "react";

const SaveButton = ({ onClick, text = "Guardar" }) => {
  const [hover, set_hover] = useState(false);

  return (
    <button
      className="btn text-white fw-bold w-100"
      type="button"
      onClick={onClick}
      style={{ backgroundColor: hover? "#FF8A38":"#FF995B", border: "none" }}
      onMouseEnter={()=>set_hover(true)}
      onMouseLeave={()=>set_hover(false)}
    >
      {text}
    </button>
  );
};

export default SaveButton;
