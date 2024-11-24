import React, { useState, useEffect, useRef } from 'react';

const Question = ({ data, onAnswerUpdate, numberOfQuestions, activeQuestion, onSetActiveQuestion, onSetStep }) => {
  const [selected, setSelected] = useState('');
  const [error, setError] = useState('');
  const radiosWrapper = useRef();

  useEffect(() => {
    // Clear any previously checked input when the question data changes
    const findCheckedInput = radiosWrapper.current.querySelector('input:checked');
    if (findCheckedInput) {
      findCheckedInput.checked = false;
    }
  }, [data]);

  const changeHandler = (e) => {
    setSelected(e.target.value);
    if (error) {
      setError('');
    }
  };

  const nextClickHandler = () => {
    if (selected === '') {
      setError('Please select one option!');
      return;
    }
    onAnswerUpdate((prevState) => [...prevState, { q: data.question, a: selected }]);
    setSelected(''); // Reset selected option for the next question

    if (activeQuestion < numberOfQuestions - 1) {
      onSetActiveQuestion(activeQuestion + 1);
    } else {
      onSetStep(3);
    }
  };

  return (
    <div className="card">
      <div className="card-content">
        <div className="content">
          <h2 className="question-text">{data.question}</h2>
          <div className="options-wrapper" ref={radiosWrapper}>
            {data.choices.map((choice, i) => (
              <label
                key={i}
                className={`radio-option ${selected === choice ? 'selected' : ''}`}
              >
                <input
                  type="radio"
                  name="answer"
                  value={choice}
                  onChange={changeHandler}
                />
                {choice}
              </label>
            ))}
          </div>
          {error && <div className="error-message">{error}</div>}
          <button className="next-button" onClick={nextClickHandler}>
            Next
          </button>
        </div>
      </div>
    </div>
  );
};

export default Question;
