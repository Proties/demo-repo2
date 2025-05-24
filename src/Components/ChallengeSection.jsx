import '../css/ChallengeSection.css';

const challenges = [
  {
    title: 'Draw Your Dreamscape',
    description: 'Create a surreal scene that represents your dreams or nightmares.',
  },
  {
    title: 'Color Challenge',
    description: 'Use only 3 colors to create a vibrant, emotional piece.',
  },
  {
    title: 'Style Swap',
    description: 'Redraw a famous artwork in your own unique style.',
  },
  {
    title: 'Time Limit Sketch',
    description: 'Set a timer for 10 minutes and sketch as much as you can!',
  },
];

const ChallengeSection = () => {
  return (
    <section className="challenge-section">
      <h3>🎨 Artist Challenges</h3>
      <ul>
        {challenges.map((challenge, index) => (
          <li key={index} className="challenge-card">
            <h4>{challenge.title}</h4>
            <p>{challenge.description}</p>
          </li>
        ))}
      </ul>
    </section>
  );
};

export default ChallengeSection;
