import React from "react";

const SelectField = ({
  label,
  id,
  value,
  options,
  onChange,
  error = "",
  style = {},
}) => {
  const defaultStyles = {
    container: {
      display: "flex",
      flexDirection: "column",
      gap: "5px",
    },
    label: {
      fontSize: "14px",
      fontWeight: "500",
      color: "#555",
    },
    select: {
      width: "100%",
      padding: "10px",
      borderRadius: "8px",
      border: error ? "1px solid #e74c3c" : "1px solid #ccc",
      fontSize: "14px",
    },
    errorText: {
      fontSize: "12px",
      color: "#e74c3c",
      marginTop: "5px",
    },
  };

  return (
    <div className="mb-4">
    <div style={{ ...defaultStyles.container, ...style.container }}>
      <label htmlFor={id} style={{ ...defaultStyles.label, ...style.label }}>
        {label}
      </label>
      <select
        id={id}
        value={value}
        onChange={onChange}
        style={{ ...defaultStyles.select, ...style.select }}
      >
        <option value="" disabled>
          Seleccione una opción
        </option>
        {options.map((option, index) => (
          <option key={index} value={option.value}>
            {option.label}
          </option>
        ))}
      </select>
      {error && <span style={{ ...defaultStyles.errorText }}>{error}</span>}
    </div>
    </div>
  );
};

export default SelectField;
