"strict"
class Analytics {
    /**
     * Initializes the Analytics class.
     * 
     * @param {string} id - Unique identifier for the analytics instance.
     */
    constructor(id) {
        /**
         * Unique identifier for the analytics instance.
         * @type {string}
         */
        this._id = id;

        /**
         * Stores daily, weekly, and monthly active user data.
         * @type {object}
         */
        this._data = {
            daily: {},
            weekly: {},
            monthly: {}
        };
    }

    /**
     * Records a user's activity.
     * 
     * @param {string} userId - ID of the user.
     * @param {string} date - Date of the activity (YYYY-MM-DD).
     */
    recordActivity(userId, date) {
        const currentDate = new Date(date);
        const day = currentDate.getDate();
        const week = currentDate_WEEK();
        const month = currentDate.getMonth() + 1;
        const year = currentDate.getFullYear();

        // Daily
        if (!this._data.daily[year]) this._data.daily[year] = {};
        if (!this._data.daily[year][month]) this._data.daily[year][month] = {};
        if (!this._data.daily[year][month][day]) this._data.daily[year][month][day] = new Set();
        this._data.daily[year][month][day].add(userId);

        // Weekly
        if (!this._data.weekly[year]) this._data.weekly[year] = {};
        if (!this._data.weekly[year][week]) this._data.weekly[year][week] = new Set();
        this._data.weekly[year][week].add(userId);

        // Monthly
        if (!this._data.monthly[year]) this._data.monthly[year] = {};
        if (!this._data.monthly[year][month]) this._data.monthly[year][month] = new Set();
        this._data.monthly[year][month].add(userId);
    }

    /**
     * Gets the number of active users for a given date range.
     * 
     * @param {string} type - 'daily', 'weekly', or 'monthly'.
     * @param {string} startDate - Start date (YYYY-MM-DD).
     * @param {string} endDate - End date (YYYY-MM-DD).
     * @returns {number} Number of active users.
     */
    getActiveUsers(type, startDate, endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        let count = 0;

        switch (type) {
            case 'daily':
                for (let date = start; date <= end; date.setDate(date.getDate() + 1)) {
                    const day = date.getDate();
                    const month = date.getMonth() + 1;
                    const year = date.getFullYear();
                    if (this._data.daily[year] && this._data.daily[year][month] && this._data.daily[year][month][day]) {
                        count += this._data.daily[year][month][day].size;
                    }
                }
                break;
            case 'weekly':
                for (let week = start.WEEK(); week <= end.WEEK(); week++) {
                    const year = start.getFullYear();
                    if (this._data.weekly[year] && this._data.weekly[year][week]) {
                        count += this._data.weekly[year][week].size;
                    }
                }
                break;
            case 'monthly':
                for (let month = start.getMonth() + 1; month <= end.getMonth() + 1; month++) {
                    const year = start.getFullYear();
                    if (this._data.monthly[year] && this._data.monthly[year][month]) {
                        count += this._data.monthly[year][month].size;
                    }
                }
                break;
        }

        return count;
    }
}

// Helper function to get the week number
Date.prototype.WEEK = function() {
    const firstDay = new Date(this.getFullYear(), 0, 1);
    return Math.ceil((((this - firstDay) / 86400000) + firstDay.getDay() + 1) / 7);
}