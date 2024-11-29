import React from 'react';

const CancelButton = ({ onClick, text = 'Cancelar' }) => {
  return (
    <button
      className="btn text-white fw-bold w-100"
      type="button"
      onClick={onClick}
      style={{ backgroundColor: '#789ECD', border: 'none' }}
    >
      {text}
    </button>
  );
};

export default CancelButton;
