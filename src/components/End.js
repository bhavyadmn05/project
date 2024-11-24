import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { formatTime } from '../utils';

const End = ({ results, data, onReset, onAnswersCheck, time, topic }) => {
    const [correctAnswers, setCorrectAnswers] = useState(0);

    useEffect(() => {
        let correct = 0;
        results.forEach((result, index) => {
            if (result.a === data[index].answer) {
                correct++;
            }
        });
        setCorrectAnswers(correct);

        // Send data to the backend
        const percentage = ((correct / data.length) * 100).toFixed(2);

        axios.post('http://localhost/ipd/saveResult.php', {
            topic: topic || 'General',
            marks: correct,
            percentage: percentage,
            time_taken: time,
        })
        .then((response) => {
            console.log('Result saved:', response.data);
        })
        .catch((error) => {
            console.error('Error saving results:', error);
        });
    }, [results, data, time, topic]);

    return (
        <div className="card">
            <div className="card-content">
                <div className="content">
                    <h3>Your results</h3>
                    <p>
                        {correctAnswers} of {data.length}
                    </p>
                    <p>
                        <strong>{Math.floor((correctAnswers / data.length) * 100)}%</strong>
                    </p>
                    <p>
                        <strong>Your time:</strong> {formatTime(time)}
                    </p>
                    <button className="button is-info mr-2" onClick={onAnswersCheck}>
                        Check your answers
                    </button>
                    <button className="button is-success" onClick={onReset}>
                        Try again
                    </button>
                </div>
            </div>
        </div>
    );
};

export default End;
