namespace app_refresher.Models;

public class ContactSubmission
{
    public string Name { get; set; } = string.Empty;
    public string Message { get; set; } = string.Empty;
    public DateTime SubmittedAtUtc { get; set; }
}
