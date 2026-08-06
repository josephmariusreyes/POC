namespace app_refresher.Models;

public class EmploymentHistoryItem
{
    public string Company { get; set; } = string.Empty;
    public string Position { get; set; } = string.Empty;
    public DateOnly StartDate { get; set; }
    public DateOnly EndDate { get; set; }
    public decimal Salary { get; set; }
    public bool IsCurrent { get; set; }
}
