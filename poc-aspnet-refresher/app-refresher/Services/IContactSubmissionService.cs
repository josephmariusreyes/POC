using app_refresher.Models;

namespace app_refresher.Services;

public interface IContactSubmissionService
{
    Task AddSubmissionAsync(ContactSubmission submission);
}
