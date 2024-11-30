import React from "react";

const SelectField = ({
  label,
  id,
  value,
  name,
  options,
  onChange,
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
      border: "1px solid #ccc",
      fontSize: "14px",
    },
  };

  return (
    <div style={{ ...defaultStyles.container, ...style.container }}>
      <label htmlFor={id} style={{ ...defaultStyles.label, ...style.label }}>
        {label}
      </label>
      <select
        id={id}
        value={value}
        onChange={onChange}
        style={{ ...defaultStyles.select, ...style.select }}
        name={name}
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
