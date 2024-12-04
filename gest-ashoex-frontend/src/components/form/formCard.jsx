import React from "react";
import Title from "../../components/typography/title";
import "./formCard.css";

const FormCard = ({ title, children }) => {
  return (
    <div className="form-container">
      <div className="card form-card">
        <div className="mb-3 text-center">
          <Title text={title} />
        </div>
        <div className="card-body">{children}</div>
      </div>
    </div>
  );
};

export default FormCard;