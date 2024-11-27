import React from 'react';

const SelectField = ({ label, options }) => {
  return (
    <div className="mb-3">
      <label className="form-label fw-bold">{label}</label>
      <select
        className="form-select"
        style={{
          borderRadius: '5px',
          boxShadow: 'inset 0 1px 3px rgba(0,0,0,0.2)',
          fontSize: '14px',
        }}
      >
        {options.map((option, index) => (
          <option key={index} value={option.value}>
            {option.label}
          </option>
        ))}
      </select>
    </div>
  );
};

export default SelectField;
