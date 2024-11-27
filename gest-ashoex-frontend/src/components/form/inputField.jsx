import React from 'react';

const InputField = ({ label, type, placeholder }) => {
  return (
    <div className="mb-3">
      <label className="form-label fw-bold">{label}</label>
      <input
        type={type}
        className="form-control"
        placeholder={placeholder}
        style={{
          borderRadius: '5px',
          boxShadow: 'inset 0 1px 3px rgba(0,0,0,0.2)',
          fontSize: '14px',
        }}
      />
    </div>
  );
};

export default InputField;
