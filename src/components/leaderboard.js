import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './leaderboard.css';  

const Leaderboard = () => {
  const [leaderboard, setLeaderboard] = useState([]);
  const [error, setError] = useState(null);

  useEffect(() => {
    // Fetch leaderboard data
    axios.get('http://localhost/ipd/getLeaderboard.php')
      .then((response) => {
        if (response.data.success) {
          setLeaderboard(response.data.leaderboard);
        } else {
          setError(response.data.message);
        }
      })
      .catch((error) => {
        setError('Error fetching leaderboard data.');
      });
  }, []);

  return (
    <div>
      <h2>Leaderboard</h2>
      {error && <p>{error}</p>}
      <table>
        <thead>
          <tr>
            <th>User Name</th>
            <th>Topic</th>
            <th>Marks</th>
            <th>Percentage</th>
            <th>Time Taken</th>
          </tr>
        </thead>
        <tbody>
          {leaderboard.length > 0 ? (
            leaderboard.map((entry, index) => (
              <tr key={index}>
                <td>{entry.user_name}</td>
                <td>{entry.topic}</td>
                <td>{entry.marks}</td>
                <td>{entry.percentage}%</td>
                <td>{entry.time_taken} seconds</td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="5">No leaderboard data available.</td>
            </tr>
          )}
        </tbody>
      </table>
    </div>
  );
};

export default Leaderboard;
