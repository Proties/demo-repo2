// src/Pages/PaymentPage.jsx
import '../css/PaymentPage.css';

const PaymentPage = () => {
  return (
    <div className="payment-container">
      <h1>Choose Your Plan</h1>
      <div className="plans">
        <div className="plan-card">
          <h2>Free</h2>
          <p>$0/month</p>
          <ul>
            <li>Basic Profile</li>
            <li>Upload up to 5 images</li>
            <li>Community Access</li>
          </ul>
          <button disabled>Current Plan</button>
        </div>

        <div className="plan-card">
          <h2>Premium</h2>
          <p>$8/month</p>
          <ul>
            <li>HD Uploads</li>
            <li>Profile Templates</li>
            <li>Unlimited Posts</li>
            <li>Early Access Features</li>
          </ul>
          <button>Subscribe</button>
        </div>
      </div>
    </div>
  );
};

export default PaymentPage;
