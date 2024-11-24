import React, { useState, useEffect } from 'react';
import Leaderboard from './components/leaderboard'; // Import the Leaderboard component
import './App.css';

import Start from './components/Start';
import Question from './components/Question';
import End from './components/End';
import Modal from './components/Modal';
import quizData from './data/quiz.json';
import axios from 'axios';  // Import axios to fetch data

let interval;

const App = () => {
  const [step, setStep] = useState(0);
  const [selectedTopic, setSelectedTopic] = useState(null);
  const [questions, setQuestions] = useState([]);
  const [activeQuestion, setActiveQuestion] = useState(0);
  const [answers, setAnswers] = useState([]);
  const [showModal, setShowModal] = useState(false);
  const [time, setTime] = useState(0);
  const [leaderboardData, setLeaderboardData] = useState([]); // State to store leaderboard data

  useEffect(() => {
    if (step === 3) {
      clearInterval(interval); // Clear the interval when quiz ends
    }
  }, [step]);

  const handleTopicSelect = (topic) => {
    setSelectedTopic(topic);
    setQuestions(quizData.topics[topic]); // Load questions for the selected topic
    setStep(1); // Move to start quiz screen
  };

  const quizStartHandler = () => {
    setStep(2);
    interval = setInterval(() => {
      setTime((prevTime) => prevTime + 1);
    }, 1000);
  };

  const resetClickHandler = () => {
    setActiveQuestion(0);
    setAnswers([]);
    setStep(2);
    setTime(0);
    interval = setInterval(() => {
      setTime((prevTime) => prevTime + 1);
    }, 1000);
  };

  const viewLeaderboardHandler = () => {
    // Fetch leaderboard data from the backend (quiz_app database)
    axios.get('http://localhost/ipd/fetchResults.php')  // Assuming this is the endpoint for leaderboard
      .then((response) => {
        if (response.data.success) {
          setLeaderboardData(response.data.data); // Store leaderboard data in state
        }
      })
      .catch((error) => {
        console.error('Error fetching leaderboard data:', error);
      });
    setStep(4); // Move to the leaderboard screen
  };

  return (
    <div className="App">
      {step === 0 && (
        <div>
          <h1>Select a Topic</h1>
          {Object.keys(quizData.topics).map((topic, index) => (
            <button key={index} onClick={() => handleTopicSelect(topic)}>
              {topic}
            </button>
          ))}
        </div>
      )}

      {step === 1 && <Start onQuizStart={quizStartHandler} />}

      {step === 2 && (
        <Question 
          data={questions[activeQuestion]}
          onAnswerUpdate={setAnswers}
          numberOfQuestions={questions.length}
          activeQuestion={activeQuestion}
          onSetActiveQuestion={setActiveQuestion}
          onSetStep={setStep}
        />
      )}

      {step === 3 && (
        <End 
          results={answers}
          data={questions}
          onReset={resetClickHandler}
          onAnswersCheck={() => setShowModal(true)}
          time={time}
          topic={selectedTopic}  // Pass selectedTopic as prop
        />
      )}

      {showModal && (
        <Modal 
          onClose={() => setShowModal(false)}
          results={answers}
          data={questions}
        />
      )}

      {/* Option to view the leaderboard after quiz completion */}
      {step === 3 && (
        <div className="view-leaderboard-btn">
          <button onClick={viewLeaderboardHandler}>View Leaderboard</button>
        </div>
      )}

      {/* Render the leaderboard only after user clicks "View Leaderboard" */}
      {step === 4 && (
        <Leaderboard 
          leaderboardData={leaderboardData} // Pass leaderboard data to the leaderboard component
          topic={selectedTopic} // Pass selected topic to the leaderboard if needed
        />
      )}
    </div>
  );
};

export default App;
